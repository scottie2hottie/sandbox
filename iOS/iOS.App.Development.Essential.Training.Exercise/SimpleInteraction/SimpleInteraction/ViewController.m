//
//  ViewController.m
//  SimpleInteraction
//
//  Created by Deng Yanming on 14-2-5.
//  Copyright (c) 2014年 Deng Yanming. All rights reserved.
//

#import "ViewController.h"

@interface ViewController ()
@property (weak, nonatomic) IBOutlet UITextField *textField;
@property (weak, nonatomic) IBOutlet UILabel *label;

@end

@implementation ViewController

- (IBAction)changeLabel:(id)sender
{
  self.label.text = [NSString stringWithFormat:@"Hello, %@", self.textField.text];
  
  [self.textField resignFirstResponder];
}

-(void)touchesBegan:(NSSet *)touches withEvent:(UIEvent *)event
{
  [self.view endEditing:YES];
}

- (BOOL)textFieldShouldReturn:(UITextField *)textField
{
  [textField resignFirstResponder];
  return YES;
}

- (void)viewDidLoad
{
    [super viewDidLoad];
	// Do any additional setup after loading the view, typically from a nib.
}

@end
