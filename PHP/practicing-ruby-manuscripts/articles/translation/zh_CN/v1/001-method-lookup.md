我决定以 Ruby 的对象模型（Ruby 是如何查找方法的）开篇。虽然这很基础，但也很重要。下面举几个例子。

下面是一个简单的 Report 类，用来操作一些基本的数据并输出文本。

```ruby
class Report
  def initialize(ledger)
    @balance          = ledger.inject(0) { |sum, (k,v)| sum + v }
    @credits, @debits = ledger.partition { |k,v| v > 0 }
  end

  attr_reader :credits, :debits, :balance

  def formatted_output
    "Current Balance: #{balance}\n\n" +
    "Credits:\n\n#{formatted_line_items(credits)}\n\n" +
    "Debits:\n\n#{formatted_line_items(debits)}"
  end

  def formatted_line_items(items)
    items.map { |k, v| "#{k}: #{'%.2f' % v.abs}" }.join("\n")
  end
end
```

下面的示例中我们将演示如何使用此类。

```ruby
ledger = [ ["Deposit Check #123", 500.15],
           ["Fancy Shoes",       -200.25],
           ["Fancy Hat",          -54.40],
           ["ATM Deposit",       1200.00],
           ["Kitteh Litteh",       -5.00] ]

report = Report.new(ledger)
puts report.formatted_output
```

如果你不想花时间复制粘贴代码，并在本地运行的话，那下面就是实际的输出。

```
Current Balance: 1440.5

Credits:

Deposit Check #123: 500.15
ATM Deposit: 1200.00

Debits:

Fancy Shoes: 200.25
Fancy Hat: 54.40
Kitteh Litteh: 5.00
```

虽然输出不是很漂亮，但差不多我们想看到也就是这个样子了。你可以想象到这些信息如何镶嵌到其他的报告中去，比如有头尾信息的电子邮件格式的报表。下面的例子中展示了用继承的方式来实现的报表镶嵌。

```ruby
require "date"

class EmailReport < Report
  def header
    "Dear Valued Customer,\n\n"+
    "This report shows your account activity as of #{Date.today}\n"
  end

  def banner
    "\n............................................................\n"
  end

  def formatted_output
    header + banner + super + banner + footer
  end

  def footer
    "\nWith Much Love,\nYour Faceless Banking Institution"
  end
end
```

我们只需修改一点点代码就能使用这个新的类了。

```ruby
ledger = [ ["Deposit Check #123", 500.15],
           ["Fancy Shoes",       -200.25],
           ["Fancy Hat",          -54.40],
           ["ATM Deposit",       1200.00],
           ["Kitteh Litteh",       -5.00] ]

report = EmailReport.new(ledger)
puts report.formatted_output
```

下面是新的输出。

```
Dear Valued Customer,

The following report shows your account activity as of 2010-11-09

............................................................
Current Balance: 1440.5

Credits:

Deposit Check #123: 500.15
ATM Deposit: 1200.00

Debits:

Fancy Shoes: 200.25
Fancy Hat: 54.40
Kitteh Litteh: 5.00
............................................................

With Much Love,
Your Faceless Banking Institution
```

回看 `EmailReport` 代码，我们很容易就能知道这些输入是如何产生的。我们定义了一个 `formatted_output` 方法来加入头尾信息，并以 `super` 来调用父类 `Report` 的相同方法。这就是继承，任何计算机科学课程以及任何面向对象的语言里都会讲到。

在你想进行退款操作并且跟朋友们说这封新闻信是如何的乏味时，思考一下这一点：尽管很多语言都有一个只基于继承的方法查找规则，但这 与 Ruby 中的实际情况还相差很远。

因为允许模块混入与单个对象行为，`super` 关键字使 Ruby 获得了新生。在 Ruby 中，对象的父类只是对象模型五部曲中的最后一部。
下面的例子通过输出一系列先后出现的字符串来证明 Ruby 中方法解析的顺序。

```ruby
module W
  def foo
    "- Mixed in method defined by W\n" + super
  end
end

module X
  def foo
    "- Mixed in method defined by X\n" + super
  end
end

module Y
  def foo
    "- Mixed in method defined by Y\n" + super
  end
end

module Z
  def foo
    "- Mixed in method defined by Z\n" + super
  end
end

class A
  def foo
    "- Instance method defined by A\n"
  end
end

class B < A
  include W
  include X

  def foo
    "- Instance method defined by B\n" + super
  end
end

object = B.new
object.extend(Y)
object.extend(Z)

def object.foo
  "- Method defined directly on an instance of B\n" + super
end

puts object.foo
```

运行代码，输出如下。 `super` 调用从对象本身一直追溯到对象的父类。

```
- Method defined directly on an instance of B
- Mixed in method defined by Z
- Mixed in method defined by Y
- Instance method defined by B
- Mixed in method defined by X
- Mixed in method defined by W
- Instance method defined by A
```

正如所说，这是五部曲。从上面的输出我们可以看出，Ruby 中方法解析的步骤可以总结如下：

1. 定义在对象单例类（比如对象本身）中的方法
1. 混入到此单例类中的模块，与混入顺序相反
1. 对象类中定义的方法
1. 对象类中混入的模块，与混入顺序相反
1. 对象的父类中定义的方法

上述过程沿着继承链被一遍一遍轮回，直到 `BasicObject`。既然已经明白了方法解析的基本顺序，我们可以停下来思考一下目前的情况。

### 开放式问题与探究

* 为何需要在 5 个不同的地方定义方法？除了继承外的几个其它方法，是不是真的可以让我们得到额外的什么好处？

* 这是否改变传统的面向对象设计原则应用到 Ruby 中去的方法？比如，你对直接将设计模式映射到 Ruby 中去了解程度如何？

* 想一下这五部曲，考虑一下哪一些是经常用到的，哪一些是仅是偶尔才用到。 单对象行为是否真的很有用处？

* 很少一次用到五部曲中的所有，在这个例子中同时使用只是为了演示。拆开了看，你能想出每种方法定义的实际使用场景吗？

* 这五种方法都有哪些缺点？

在下一期中，我将谈到这些点，并讲讲一些实际的应用。请在下面的评论部分分享你的观点。

> **注意:** 这篇文字还在 Ruby Best Practices 博客发表。[可能在这儿还有一些评论](http://blog.rubybestpractices.com/posts/gregory/030-issue-1-method-lookup.html#disqus_thread) 
值得看看。
