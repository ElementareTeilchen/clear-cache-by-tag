# TYPO3 Extension `clear-cache-by-tag`

This TYPO3 extension allows to clear TYPO3 caches by defying cache
tags. Caches can be cleared using console command or via
scheduler task. TYPO3 core cache handling functions will be used,
so it also works with e.g. staticfilecache.

## Installation

Install this extension as dependency via `composer req elementareteilchen/clear-cache-by-tag`.


## Usage

### CLI
Call command via console and define cache tags to clear.
Multiple cache tags can be provided via comma separated list.

```bash
vendor/bin/typo3 clear-cache-by-tag:clearByTag tag1
vendor/bin/typo3 clear-cache-by-tag:clearByTag tag1,tag2,tag3
```

### Scheduler
Create a new scheduler task.

Select:
* **Class**: "Execute console commands"
* **Frequency**: Has to be defined in order to save a scheduler task.
* **Schedulable Command. Save and reopen to define command arguments**: `clear-cache-by-tag:clearByTag: Clear TYPO3 caches by cache tag`
* **Save**: In order to be able to configure the arguments of this command
* **Argument: tag. Comma separated list of tags to clear cache for**: Add comma separated list of cache tags to flush caches for
