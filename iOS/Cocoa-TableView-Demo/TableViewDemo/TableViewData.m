//
//  TableViewData.m
//  TableViewDemo
//
//  Created by Deng Yanming on 14-2-22.
//  Copyright (c) 2014年 Deng Yanming. All rights reserved.
//

#import "TableViewData.h"

@implementation TableViewData

NSArray *languages;

-(void)awakeFromNib
{
  languages = [NSLocale preferredLanguages];
}

- (NSInteger)numberOfRowsInTableView:(NSTableView *)aTableView
{
  return [languages count];
}

- (id)tableView:(NSTableView *)aTableView objectValueForTableColumn:(NSTableColumn *)aTableColumn row:(NSInteger)rowIndex
{
  if ([aTableColumn.identifier isEqualToString:@"left"]) {
    return [languages objectAtIndex:rowIndex];
  } else {
    return [[NSLocale currentLocale] displayNameForKey:NSLocaleIdentifier value:[languages objectAtIndex:rowIndex]];
  }
 
}

@end
