//
//  ViewController.h
//  ProteinTracker
//
//  Created by Deng Yanming on 14-2-4.
//  Copyright (c) 2014年 Deng Yanming. All rights reserved.
//

#import <UIKit/UIKit.h>
#import "HistoryViewController.h"

@interface MainViewController : UIViewController {
  int total;
  NSMutableArray *amountHistory;
}
@property (weak, nonatomic) IBOutlet UILabel *totalLabel;
@property (weak, nonatomic) IBOutlet UILabel *goalLabel;
@property (weak, nonatomic) IBOutlet UITextField *amountText;
- (IBAction)addProtein:(id)sender;
- (IBAction)unwindToMain:(UIStoryboardSegue *)segue;
- (void)goalChanged:(NSNotification *)notification;

@end
