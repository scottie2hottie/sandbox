//
//  ViewController.m
//  DatePicker
//
//  Created by Deng Yanming on 14-2-5.
//  Copyright (c) 2014年 Deng Yanming. All rights reserved.
//

#import "ViewController.h"

@interface ViewController ()
@property (weak, nonatomic) IBOutlet UIDatePicker *datePicker;

@end

@implementation ViewController


- (IBAction)checkDay:(id)sender
{
  NSDate *chosenDate = [self.datePicker date];
  NSDateFormatter *formatter = [[NSDateFormatter alloc] init];
  [formatter setDateFormat:@"EEEE"];
  NSString *weekday = [formatter stringFromDate:chosenDate];
  NSString *msg = [NSString stringWithFormat:@"%@", weekday];
  UIAlertView *alert = [[UIAlertView alloc] initWithTitle:@"What day is it?" message:msg delegate:nil cancelButtonTitle:@"OK" otherButtonTitles:nil, nil];
  [alert show];
}

- (void)viewDidLoad
{
    [super viewDidLoad];
	// Do any additional setup after loading the view, typically from a nib.
}

- (void)didReceiveMemoryWarning
{
    [super didReceiveMemoryWarning];
    // Dispose of any resources that can be recreated.
}

@end
