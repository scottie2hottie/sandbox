//
//  ViewController.m
//  TableView
//
//  Created by Deng Yanming on 14-2-6.
//  Copyright (c) 2014年 Deng Yanming. All rights reserved.
//

#import "ViewController.h"

@interface ViewController ()

@end

@implementation ViewController {
  NSDictionary *courseDetails;
  NSArray *justCourseNames;
  
  NSDictionary *webCourseDetails;
  NSArray *webCourseNames;
}

- (void)viewDidLoad
{
  [super viewDidLoad];
  NSURL *url = [[NSBundle mainBundle] URLForResource:@"courses" withExtension:@"plist"];
  courseDetails = [NSDictionary dictionaryWithContentsOfURL:url];
  justCourseNames = [courseDetails allKeys];
  
  NSURL *webUrl = [[NSBundle mainBundle] URLForResource:@"courses_web" withExtension:@"plist"];
  webCourseDetails = [NSDictionary dictionaryWithContentsOfURL:webUrl];
  webCourseNames = [webCourseDetails allKeys];
}

-(NSInteger)numberOfSectionsInTableView:(UITableView *)tableView
{
  return 2;
}

-(NSString *)tableView:(UITableView *)tableView titleForHeaderInSection:(NSInteger)section
{
  if (section == 0) {
    return @"iOS courses";
  } else {
    return @"Web courses";
  }
}

-(UITableViewCell *)tableView:(UITableView *)tableView cellForRowAtIndexPath:(NSIndexPath *)indexPath
{
//  UITableViewCell *cell = [[UITableViewCell alloc] initWithStyle:UITableViewCellStyleDefault reuseIdentifier:@"cell"];
  
  //复用单元格
  UITableViewCell *cell = [tableView dequeueReusableCellWithIdentifier:@"cell"];
  
  UIImage *cellImage = [UIImage imageNamed:@"CellImage"];
  [cell.imageView setImage:cellImage];
  
  if (indexPath.section == 0) {
    cell.textLabel.text = [justCourseNames objectAtIndex:[indexPath row]];
  } else {
    cell.textLabel.text = [webCourseNames objectAtIndex:[indexPath row]];
  }
  
  return cell;
}

-(NSInteger)tableView:(UITableView *)tableView numberOfRowsInSection:(NSInteger)section
{
  if (section == 0) {
    return [justCourseNames count];
  } else {
    return [webCourseNames count];
  }
}

@end
