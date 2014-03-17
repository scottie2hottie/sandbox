//
//  SSSViewController.m
//  Switch_Slider_Segment
//
//  Created by Deng Yanming on 14-2-4.
//  Copyright (c) 2014年 Deng Yanming. All rights reserved.
//

#import "SSSViewController.h"

@interface SSSViewController ()

@end

@implementation SSSViewController

- (void)viewDidLoad
{
    [super viewDidLoad];
	// Do any additional setup after loading the view, typically from a nib.
  self.sliderValue.text = [NSString stringWithFormat:@"0"];
  self.rightSwitch.hidden = YES;
  self.leftSwitch.hidden = NO;
}

- (void)didReceiveMemoryWarning
{
    [super didReceiveMemoryWarning];
    // Dispose of any resources that can be recreated.
}

- (IBAction)valueChanged:(id)sender
{
  UISwitch *currentSwitch = (UISwitch *)sender;
  BOOL isON = currentSwitch.isOn;
  [self.leftSwitch setOn:isON animated:YES];
  [self.rightSwitch setOn:isON];
}

- (IBAction)sliderValueChange:(id)sender
{
  UISlider *slider = (UISlider *)sender;
  int currentSliderValue = (int) (slider.value + 0.5f);
//  NSLog(@"%i", currentSliderValue);
  self.sliderValue.text = [NSString stringWithFormat:@"%d", currentSliderValue];
}

- (IBAction)touchDown:(id)sender
{
  UISegmentedControl *seg = (UISegmentedControl *)sender;
  long int selectedIndex = (long)seg.selectedSegmentIndex;
  if (selectedIndex == 0) {
    self.leftSwitch.hidden = NO;
    self.rightSwitch.hidden = YES;
  } else {
    self.leftSwitch.hidden = YES;
    self.rightSwitch.hidden = NO;
  }
}

@end
