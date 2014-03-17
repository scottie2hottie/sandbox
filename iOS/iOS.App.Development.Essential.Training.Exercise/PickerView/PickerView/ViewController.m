//
//  ViewController.m
//  PickerView
//
//  Created by Deng Yanming on 14-2-5.
//  Copyright (c) 2014年 Deng Yanming. All rights reserved.
//

#import "ViewController.h"

@interface ViewController ()
@property NSArray *moods;
@end

@implementation ViewController

- (void)viewDidLoad
{
  [super viewDidLoad];
  self.moods = @[@"高兴", @"不高兴", @"悲伤", @"就那样", @"还好", @"不好", @"保密"];
}

-(NSInteger)pickerView:(UIPickerView *)pickerView numberOfRowsInComponent:(NSInteger)component
{
  return [self.moods count];
}

-(NSInteger)numberOfComponentsInPickerView:(UIPickerView *)pickerView
{
  return 1;
}

-(NSString *)pickerView:(UIPickerView *)pickerView titleForRow:(NSInteger)row forComponent:(NSInteger)component
{
  return self.moods[row];
}

-(void)pickerView:(UIPickerView *)pickerView didSelectRow:(NSInteger)row inComponent:(NSInteger)component
{
  UIColor *moodColor;
  
  switch (row) {
    case 0: case 1: case 2:
      moodColor = [UIColor darkGrayColor];
      break;
    case 3: case 4: case 5:
      moodColor = [UIColor yellowColor];
      break;
    case 6:
      moodColor = [UIColor redColor];
      break;
      
    default:
      moodColor = [UIColor greenColor];
      break;
  }
  
  self.view.backgroundColor = moodColor;
}

@end
