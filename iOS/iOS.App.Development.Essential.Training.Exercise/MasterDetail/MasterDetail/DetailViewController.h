//
//  DetailViewController.h
//  MasterDetail
//
//  Created by Deng Yanming on 14-2-6.
//  Copyright (c) 2014年 Deng Yanming. All rights reserved.
//

#import <UIKit/UIKit.h>

@interface DetailViewController : UIViewController <UISplitViewControllerDelegate>

@property (strong, nonatomic) id detailItem;

@property (weak, nonatomic) IBOutlet UILabel *detailDescriptionLabel;
@end
