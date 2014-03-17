//
//  LotteryEntry.h
//  lottery
//
//  Created by Deng Yanming on 14-2-3.
//  Copyright (c) 2014年 Deng Yanming. All rights reserved.
//

#import <Foundation/Foundation.h>

@interface LotteryEntry : NSObject {
  NSDate *entryDate;
  int firstNumber;
  int secondNumber;
}

- (void)prepareRandomNumbers;
- (void)setEntryDate:(NSDate *)date;
- (NSDate *)entryDate;
- (int)firstNumber;
- (int)secondNumber;

@end
