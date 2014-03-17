//
//  AppDelegate.m
//  VillainTracker
//
//  Created by Deng Yanming on 14-3-5.
//  Copyright (c) 2014年 Deng Yanming. All rights reserved.
//


#define kName @"name"
#define kLastKnownLocation @"lastKnownLocation"
#define kLastSeenDate @"lastSeenDate"
#define kSwornEnemy @"swornEnemy"
#define kPrimaryMotivation @"primaryMotivation"
#define kPowers @"powers"
#define kPowerSource @"powerSource"
#define kEvilness @"evilness"
#define kMugshot @"mugshot"
#define kNotes @"notes"

#import "AppDelegate.h"

@implementation AppDelegate

- (void)applicationDidFinishLaunching:(NSNotification *)aNotification
{
  self.villain = [[NSMutableDictionary alloc] initWithObjectsAndKeys:
                  @"Lex Luthor", kName,
                  @"Smallville", kLastKnownLocation,
                  [NSDate date], kLastSeenDate,
                  @"Superman", kSwornEnemy,
                  @"Revenge", kPrimaryMotivation,
                  [NSArray arrayWithObjects:@"Evil Genius", nil], kPowers,
                  @"Superhero action", kPowerSource,
                  @2, kEvilness,
                  [NSImage imageNamed:@"NSUser"], kMugshot,
                  @"well", kNotes,
                  nil];
  [self updateDetailViews];
}

- (IBAction)takeName:(id)sender
{
  [self.villain setObject:[sender stringValue] forKey:kName];}

- (IBAction)takeLastKnowLocation:(id)sender
{
  [self.villain setObject:[sender stringValue] forKey:kLastKnownLocation];}

- (IBAction)takeLastSeen:(id)sender
{
  [self.villain setObject:[sender dateValue] forKey:kLastSeenDate];}

- (IBAction)takeSwornEnemy:(id)sender
{
  [self.villain setObject:[sender stringValue] forKey:kSwornEnemy];
}

- (IBAction)takeEvilness:(id)sender
{
  [self.villain setObject:[NSNumber numberWithInteger:[sender integerValue]] forKey:kEvilness];
}


- (IBAction)takePowerSource:(id)sender
{
  [self.villain setObject:[sender title] forKey:kPowerSource];
}

- (IBAction)takePrimaryMovitation:(id)sender
{
  [self.villain setObject:[[sender selectedCell] title]
                   forKey:kPrimaryMotivation];
}

- (IBAction)takeMugShot:(id)sender
{
  [self.villain setObject:[sender image] forKey:kMugshot];
}

- (IBAction)takePowers:(id)sender
{
  NSMutableArray *powers = [NSMutableArray array];
  for (NSCell *cell in [sender cells]) {
    if ([cell state]==NSOnState) {
      [powers addObject:[cell title]];
    }
  }
  [self.villain setObject:powers forKey:kPowers];
}

- (void) updateDetailViews
{
  [self.name setStringValue:[self.villain objectForKey:kName]];
  [self.lastKnowLocation setStringValue:[self.villain objectForKey:kLastKnownLocation]];
  [self.lastSeenDate setDateValue:[self.villain objectForKey:kLastSeenDate]];
  [self.evilness setIntegerValue:[[self.villain objectForKey:kEvilness] integerValue]];
  [self.powerSource setTitle:[self.villain objectForKey:kPowerSource]];
  [self.mugShot setImage:[self.villain objectForKey:kMugshot]];
  [self.notes setString:[self.villain objectForKey:kNotes]];
  
  
  if ([self.swornEnemy indexOfItemWithObjectValue:[self.villain objectForKey:kSwornEnemy]] == NSNotFound) {
    [self.swornEnemy addItemWithObjectValue:[self.villain objectForKey:kSwornEnemy]];
  }
  [self.swornEnemy selectItemWithObjectValue:[self.villain objectForKey:kSwornEnemy]];
  
  NSArray *motivations = [[self class] motivations];

  id primaryMotivation = [self.villain objectForKey:kPrimaryMotivation];
  NSInteger motivationIndex = [motivations indexOfObject:primaryMotivation];
  [self.primaryMotivation selectCellWithTag:motivationIndex];
  
  [self.powers deselectAllCells];
  for (NSString *power in [[self class] powers]) {
    if ([[self.villain objectForKey:kPowers] containsObject:power]) {
      [[self.powers cellWithTag:[[[self class] powers] indexOfObject:power]] setState:NSOnState];
    } }
}

+ (NSArray *)motivations {
  static NSArray *motivations = nil;
  if (!motivations) {
    motivations = [[NSArray alloc] initWithObjects:@"Greed",
                   @"Revenge", @"Bloodlust", @"Nihilism", @"Insanity", nil];
  }
  return motivations;
}

+ (NSArray *)powers {
  static NSArray *powers = nil;
  if (!powers) {
    powers = [[NSArray alloc] initWithObjects:@"Evil Genius",
              @"Mind Reader", @"Nigh-invulnerable", @"Weather Control", nil];
  }
  return powers;
}

- (void)textDidChange:(NSNotification *)aNotification {
  [self.villain setObject:[[self.notes string] copy] forKey:kNotes];
}

@end
