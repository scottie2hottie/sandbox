//
//  AppDelegate.m
//  Chapter 4
//
//  Created by Deng Yanming on 14-3-5.
//  Copyright (c) 2014年 Deng Yanming. All rights reserved.
//

#import "AppDelegate.h"

@implementation AppDelegate

- (void)applicationDidFinishLaunching:(NSNotification *)aNotification
{
  // Insert code here to initialize your application
}

- (IBAction)btnPressed:(NSButton *)sender
{
  self.label.title = [NSString stringWithFormat:@"%@ button pressed.", [sender title]];
}

-(BOOL)applicationShouldTerminateAfterLastWindowClosed:(NSApplication *)sender
{
  return YES;
}

@end
