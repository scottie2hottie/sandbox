//
//  MainViewController.h
//  iPadUtility
//
//  Created by Deng Yanming on 14-2-6.
//  Copyright (c) 2014年 Deng Yanming. All rights reserved.
//

#import "FlipsideViewController.h"

@interface MainViewController : UIViewController <FlipsideViewControllerDelegate, UIPopoverControllerDelegate>

@property (strong, nonatomic) UIPopoverController *flipsidePopoverController;

@end
