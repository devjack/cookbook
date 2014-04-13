
# Cookbook
Cookbook is a simple library to help determine the most optimal thing to cook for dinner.
It's the driving brains behind https://bitbucket.org/sydnerdrage/recipefinder

[![Build Status](https://travis-ci.org/sydnerdrage/cookbook.svg?branch=master)](https://travis-ci.org/sydnerdrage/cookbook)
[![Coverage Status](https://coveralls.io/repos/sydnerdrage/cookbook/badge.png)](https://coveralls.io/r/sydnerdrage/cookbook)

## Version: 1.0.1

### Roadmap
v1.1
 - Combine entity classes for 'food' and allow the absense of an expiry field to indicate the difference over type.
 - Refactor DecisionManager to be Recipe agnostic, preferring instead to be based on generic datasets.

v2.0
 - Implement further decision strategies such as price of expired food
 - Refactor the Fridge class to distinguish between data set logic and business checks.