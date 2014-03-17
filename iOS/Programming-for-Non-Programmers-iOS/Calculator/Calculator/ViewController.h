//
//  ViewController.h
//  Calculator
//
//  Created by Deng Yanming on 14-2-9.
//  Copyright (c) 2014年 Deng Yanming. All rights reserved.
//

#import <UIKit/UIKit.h>

@interface ViewController : UIViewController {
  int total;
  int leftOperand;
  int mode;
  NSString *userInput;
  IBOutlet UILabel *label;
  BOOL lastButtonWasMode;
}

-(IBAction)tappedClear:(id)sender;
-(IBAction)tappedNumber:(UIButton *)btn;
-(IBAction)tappedMinus:(id)sender;
-(IBAction)tappedPlus:(id)sender;
-(IBAction)tappedEquals:(id)sender;

@end
