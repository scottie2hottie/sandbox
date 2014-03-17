//
//  RandomController.m
//  Random
//
//  Created by Deng Yanming on 14-1-29.
//  Copyright (c) 2014年 Deng Yanming. All rights reserved.
//

#import "RandomController.h"

@implementation RandomController

- (IBAction)seed:(id)sender {
  NSLog(@"seed");
  srandom((unsigned)time(NULL));
  [self.label setStringValue:@"Generator seed"];
}

- (IBAction)generate:(id)sender
{
  int generated = (int)(random() % 100 + 1);
  NSLog(@"generated %d", generated);
  [self.label setIntValue:generated];
}

- (void) awakeFromNib
{
  [self.label setStringValue:@""];
}
@end
