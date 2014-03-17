//
//  ViewController.m
//  Calculator
//
//  Created by Deng Yanming on 14-2-9.
//  Copyright (c) 2014年 Deng Yanming. All rights reserved.
//

#import "ViewController.h"

@interface ViewController ()

@end

@implementation ViewController

- (void)viewDidLoad
{
  [super viewDidLoad];
	userInput = @"";
}

-(IBAction)tappedClear:(id)sender
{
  total = 0;
  leftOperand = 0;
  mode = 0;
  userInput = @"";
  label.text = @"0";
}

-(IBAction)tappedNumber:(UIButton *)btn
{
  int num = btn.tag;
  
  if (num == 0 && total == 0) {
    return;
  }
  
  NSLog(@"%i", lastButtonWasMode);
  
  if (lastButtonWasMode) {
    lastButtonWasMode = NO;
    userInput = @"";
  }
  
  userInput = [userInput stringByAppendingString:[NSString stringWithFormat:@"%i", num]];
  NSNumberFormatter *nf = [[NSNumberFormatter alloc] init];
  [nf setNumberStyle:NSNumberFormatterDecimalStyle];
  NSNumber *n = [nf numberFromString:userInput];
  NSLog(@"%@", userInput);
  label.text = [nf stringFromNumber:n];
  
//  leftOperand = [userInput intValue];
}

-(IBAction)tappedMinus:(id)sender
{
  [self setMode:-1];
}

-(IBAction)tappedPlus:(id)sender
{
  [self setMode:1];
}

-(IBAction)tappedEquals:(id)sender
{
  if (mode == 0) {
    return;
  }
  
  switch (mode) {
    case 1:
      total = leftOperand + [userInput intValue];
      break;
      
    case -1:
      total = leftOperand - [userInput intValue];
      break;
      
    default:
      break;
  }
  
  userInput = [NSString stringWithFormat:@"%i", total];
  NSNumberFormatter *nf = [[NSNumberFormatter alloc] init];
  [nf setNumberStyle:NSNumberFormatterDecimalStyle];
  NSNumber *n = [nf numberFromString:userInput];
  NSLog(@"%@", n);
  label.text = [nf stringFromNumber:n];
  mode = 0;
}

-(void)setMode:(int)_mode
{
//  if (total == 0) {
//    return;
//  }
  
  leftOperand = [userInput intValue];
  
  mode = _mode;
  lastButtonWasMode = YES;
}

@end