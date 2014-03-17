//
//  ViewController.m
//  Tipid
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
  [self.billAmount becomeFirstResponder];
}

- (void)didReceiveMemoryWarning
{
    [super didReceiveMemoryWarning];
    // Dispose of any resources that can be recreated.
}

- (IBAction)tipSelected:(id)sender
{
  [self updateDisplayedTip];
  [self updateDisplayedTotal];
  
  [self.billAmount resignFirstResponder];
}

- (NSString *)formatCurrency:(float)amount
{
  NSNumberFormatter *nf = [[NSNumberFormatter alloc] init];
  nf.numberStyle = NSNumberFormatterCurrencyStyle;
  return [nf stringFromNumber:[NSNumber numberWithInt:amount]];
}

- (void)displayTotalAmount:(float)amount
{
  self.billAmount.text = [self formatCurrency:amount];
}

- (void)displayTipAmount:(float)amount
{
  self.tipAmount.text = [self formatCurrency:amount];
}

- (float)calculateTipPercentageForSegment:(int)segment
{
  NSString *tipText = [self.tipPercent titleForSegmentAtIndex:segment];
//  NSLog(@"%f", [tipText floatValue]);
  return [tipText floatValue] / 100.0;
}

- (float)getBillAmount
{
  return [self.billAmount.text floatValue];
}

- (float)calculateTipAmount:(float)amount percent:(float)percent
{
  return amount * percent;
}

- (void)updateDisplayedTip
{
  float amount = [self getBillAmount];
  int segment = self.tipPercent.selectedSegmentIndex;
  float percent = [self calculateTipPercentageForSegment:segment];
  float tip = [self calculateTipAmount:amount percent:percent];
  self.tipAmount.text = [self formatCurrency:tip];
}

- (void)updateDisplayedTotal
{
  float amount = [self getBillAmount];
  int segment = self.tipPercent.selectedSegmentIndex;
  float percent = [self calculateTipPercentageForSegment:segment];
  float tip = [self calculateTipAmount:amount percent:percent];
  self.totalAmount.text = [self formatCurrency:tip+amount];
}



@end
