//
//  RandomController.h
//  Random
//
//  Created by Deng Yanming on 14-1-29.
//  Copyright (c) 2014年 Deng Yanming. All rights reserved.
//

#import <Foundation/Foundation.h>

@interface RandomController : NSObject
@property (weak) IBOutlet NSTextField *label;


- (IBAction)seed:(id)sender;
- (IBAction)generate:(id)sender;

@end
