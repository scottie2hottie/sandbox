//
//  SSSViewController.h
//  Switch_Slider_Segment
//
//  Created by Deng Yanming on 14-2-4.
//  Copyright (c) 2014年 Deng Yanming. All rights reserved.
//

#import <UIKit/UIKit.h>

@interface SSSViewController : UIViewController
@property (strong, nonatomic) IBOutlet UISwitch *leftSwitch;
@property (strong, nonatomic) IBOutlet UISwitch *rightSwitch;
@property (weak, nonatomic) IBOutlet UILabel *sliderValue;

- (IBAction)valueChanged:(id)sender;
- (IBAction)sliderValueChange:(id)sender;
- (IBAction)touchDown:(id)sender;

@end
