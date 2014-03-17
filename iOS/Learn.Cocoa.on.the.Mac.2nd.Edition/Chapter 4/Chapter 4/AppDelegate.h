//
//  AppDelegate.h
//  Chapter 4
//
//  Created by Deng Yanming on 14-3-5.
//  Copyright (c) 2014年 Deng Yanming. All rights reserved.
//

#import <Cocoa/Cocoa.h>

@interface AppDelegate : NSObject <NSApplicationDelegate>

@property (assign) IBOutlet NSWindow *window;
@property (weak) IBOutlet NSTextFieldCell *label;
- (IBAction)btnPressed:(NSButton *)sender;

@end
