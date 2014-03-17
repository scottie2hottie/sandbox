//
//  ViewController.h
//  Tipid
//
//  Created by Deng Yanming on 14-2-9.
//  Copyright (c) 2014年 Deng Yanming. All rights reserved.
//

#import <UIKit/UIKit.h>

@interface ViewController : UIViewController
@property (weak, nonatomic) IBOutlet UITextField *billAmount;
@property (weak, nonatomic) IBOutlet UISegmentedControl *tipPercent;
@property (weak, nonatomic) IBOutlet UITextField *tipAmount;
@property (weak, nonatomic) IBOutlet UITextField *totalAmount;
- (IBAction)tipSelected:(id)sender;
- (void)displayTotalAmount:(float)amount;
- (void)displayTipAmount:(float)amount;
- (float)calculateTipPercentageForSegment:(int)segment;
- (float)getBillAmount;
- (float)calculateTipAmount:(float)amount percent:(float)percent;
- (void)updateDisplayedTip;
- (void)updateDisplayedTotal;
@end
