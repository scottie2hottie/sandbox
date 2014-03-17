//
//  HistoryViewController.h
//  ProteinTracker
//
//  Created by Deng Yanming on 14-2-4.
//  Copyright (c) 2014年 Deng Yanming. All rights reserved.
//

#import <UIKit/UIKit.h>

@interface HistoryViewController : UIViewController {
  NSMutableArray *history;
}

@property (weak, nonatomic) IBOutlet UILabel *historyLabel;
- (void) setHistory:(NSMutableArray *)h;
@end
