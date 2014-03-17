//
//  ViewController.m
//  ProteinTracker
//
//  Created by Deng Yanming on 14-2-4.
//  Copyright (c) 2014年 Deng Yanming. All rights reserved.
//

#import "MainViewController.h"

@interface MainViewController ()

@end

@implementation MainViewController

- (id) initWithCoder:(NSCoder *)aDecoder
{
  self = [super initWithCoder:aDecoder];
  if (self) {
    amountHistory = [[NSMutableArray alloc] init];
  }
  return self;
}

- (void)viewDidLoad
{
  [super viewDidLoad];
  NSInteger goal = [[NSUserDefaults standardUserDefaults] integerForKey:@"goal"];
  self.goalLabel.text = [NSString stringWithFormat:@"%d", goal];
  NSNotificationCenter *center = [NSNotificationCenter defaultCenter];
  [center addObserver:self selector:@selector(goalChanged:) name:NSUserDefaultsDidChangeNotification object:nil];
}

- (void)goalChanged:(NSNotification *)notification
{
  NSUserDefaults *defaults = (NSUserDefaults *)[notification object];
  NSInteger goal = [defaults integerForKey:@"goal"];
  self.goalLabel.text = [NSString stringWithFormat:@"%d", goal];
}


- (IBAction)addProtein:(id)sender
{
  int amount = self.amountText.text.intValue;
  total += amount;
  [amountHistory addObject:[NSNumber numberWithInt:amount]];
  self.totalLabel.text = [NSString stringWithFormat:@"%d", total];
  
  if (total >= self.goalLabel.text.intValue) {
    UIAlertView *alert = [[UIAlertView alloc] initWithTitle:@"Success!" message:@"You reached your goal!" delegate:self cancelButtonTitle:@"OK" otherButtonTitles:nil, nil];
    [alert show];
  }
}

- (void)touchesBegan:(NSSet *)touches withEvent:(UIEvent *)event
{
  [self.view endEditing:YES];
}

- (IBAction)unwindToMain:(UIStoryboardSegue *)segue
{}


- (void) prepareForSegue:(UIStoryboardSegue *)segue sender:(id)sender
{
  if ([segue.identifier isEqualToString:@"showHistory"]) {
//    NSLog(@"%@", amountHistory);
    HistoryViewController *controller = (HistoryViewController *)segue.destinationViewController;
    [controller setHistory:amountHistory];
  }
}

@end
