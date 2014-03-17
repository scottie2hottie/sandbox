//
//  MasterViewController.h
//  MasterDetail
//
//  Created by Deng Yanming on 14-2-6.
//  Copyright (c) 2014年 Deng Yanming. All rights reserved.
//

#import <UIKit/UIKit.h>

@class DetailViewController;

@interface MasterViewController : UITableViewController

@property (strong, nonatomic) DetailViewController *detailViewController;

@end
