//
//  LotteryEntry.m
//  lottery
//
//  Created by Deng Yanming on 14-2-3.
//  Copyright (c) 2014年 Deng Yanming. All rights reserved.
//

#import "LotteryEntry.h"

@implementation LotteryEntry

- (void)prepareRandomNumbers
{
  firstNumber = (int)random()%100 + 1;
  secondNumber = (int)random()%100 + 1;
}

- (void)setEntryDate:(NSDate *)date
{
  entryDate = date;
}

- (NSDate *)entryDate
{
  return entryDate;
}

- (int)firstNumber
{
  return firstNumber;
}

- (int)secondNumber
{
  return secondNumber;
}

- (NSString *)description
{
  NSDateFormatter *df = [[NSDateFormatter alloc] init];
  [df setTimeStyle:NSDateFormatterNoStyle];
  [df setDateStyle:NSDateFormatterMediumStyle];
  
//  return [NSString alloc] initWithFormat:@"%@ = %i, %i", [df stringFromDate:entryDate], firstNumber, secondNumber];
  return [NSString stringWithFormat:@"%@ = %i, %i", [df stringFromDate:entryDate], firstNumber, secondNumber];
}

@end
