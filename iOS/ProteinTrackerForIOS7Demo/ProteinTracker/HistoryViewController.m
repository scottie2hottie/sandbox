//
//  HistoryViewController.m
//  ProteinTracker
//
//  Created by Deng Yanming on 14-2-4.
//  Copyright (c) 2014年 Deng Yanming. All rights reserved.
//

#import "HistoryViewController.h"

@interface HistoryViewController ()

@end

@implementation HistoryViewController

- (id)initWithNibName:(NSString *)nibNameOrNil bundle:(NSBundle *)nibBundleOrNil
{
    self = [super initWithNibName:nibNameOrNil bundle:nibBundleOrNil];
    if (self) {
        // Custom initialization
    }
    return self;
}

- (void)viewDidLoad
{
  [super viewDidLoad];
  NSMutableString *text = [[NSMutableString alloc] init];
  for (NSNumber *number in history) {
    [text appendFormat:@"%@\n", number];
  }
  self.historyLabel.text = text;
  NSLog(@"%@", text);
}

- (void) setHistory:(NSMutableArray *)h
{
  history = h;
  NSLog(@"%@", history);
}

@end
