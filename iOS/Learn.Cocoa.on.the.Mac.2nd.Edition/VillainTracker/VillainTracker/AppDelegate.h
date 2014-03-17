//
//  AppDelegate.h
//  VillainTracker
//
//  Created by Deng Yanming on 14-3-5.
//  Copyright (c) 2014年 Deng Yanming. All rights reserved.
//

#import <Cocoa/Cocoa.h>

@interface AppDelegate : NSObject <NSApplicationDelegate>

@property (assign) IBOutlet NSWindow *window;
@property (weak) IBOutlet NSTextField *name;
@property (weak) IBOutlet NSTextField *lastKnowLocation;
@property (weak) IBOutlet NSDatePicker *lastSeenDate;
@property (weak) IBOutlet NSComboBox *swornEnemy;
@property (weak) IBOutlet NSLevelIndicator *evilness;
@property (weak) IBOutlet NSMatrix *primaryMotivation;
@property (weak) IBOutlet NSMatrix *powers;
@property (weak) IBOutlet NSPopUpButton *powerSource;
@property (weak) IBOutlet NSImageView *mugShot;
@property (unsafe_unretained) IBOutlet NSTextView *notes;


@property (strong) NSMutableDictionary *villain;

- (IBAction)takeName:(id)sender;
- (IBAction)takeLastKnowLocation:(id)sender;
- (IBAction)takeLastSeen:(id)sender;
- (IBAction)takeSwornEnemy:(id)sender;
- (IBAction)takeEvilness:(id)sender;
- (IBAction)takePowerSource:(id)sender;
- (IBAction)takePrimaryMovitation:(id)sender;
- (IBAction)takeMugShot:(id)sender;
- (IBAction)takePowers:(id)sender;



@end
