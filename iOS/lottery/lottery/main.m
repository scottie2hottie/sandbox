//
//  main.m
//  lottery
//
//  Created by Deng Yanming on 14-2-3.
//  Copyright (c) 2014年 Deng Yanming. All rights reserved.
//

#import <Foundation/Foundation.h>
#import "LotteryEntry.h"

int main(int argc, const char * argv[])
{

  @autoreleasepool {
      
//    NSMutableArray *array = [[NSMutableArray alloc] init];
//    int i;
//    for (i=0; i<10; i++) {
//      NSNumber *number = [[NSNumber alloc] initWithInt:(i*3)];
//      [array addObject:number];
//    }
//    
//    NSLog(@"%@", array);
    
    
    NSMutableArray *array = [[NSMutableArray alloc] init];
    int i;
    
    NSDateComponents *weekComponents = [[NSDateComponents alloc] init];
    NSCalendar *cal = [NSCalendar currentCalendar];
    NSDate *now = [[NSDate alloc] init];
    
    for (i=0; i<10; i++) {
      [weekComponents setWeek:i];
      NSDate *iWeeksFromNow = [cal dateByAddingComponents:weekComponents toDate:now options:0];
      
      
      LotteryEntry *lotteryEntry = [[LotteryEntry alloc] init];
      [lotteryEntry prepareRandomNumbers];
      [lotteryEntry setEntryDate:iWeeksFromNow];
      [array addObject:lotteryEntry];
    }
    
//    NSLog(@"%@", array);
    
    for (LotteryEntry *entry in array) {
      NSLog(@"%@", entry);
    }
    
  }
    return 0;
}

