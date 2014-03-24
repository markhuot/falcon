## Falcon

# Todo

1. Hover on back pages needs to reveal more.
2. Updating a current page needs to refresh back pages too. Probably with an `X-Paged-Refresh: /content` header.
3. Ajax loading a new page needs to scroll to the top.
4. Refreshing a background page needs to preserve scroll, as best we can.
5. Update the edit view to use a more ["document" style](http://dribbble.com/shots/1275359-Document/attachments/175753)
6. Use "timeline" inspiration for the fields. Region gets a dot, line goes down to blocks in region (with dots for each)

----

Falcon is a content management system to it's core. It doesn't bother with front-end templates or XXXX.

Falcon is broken down into three major components:

1. Content types, managed by a developer
2. Regions, managed by a developer
3. Blocks, managed by a content editor

### Content types

A content type represents a collection or category of data. It has a defined structure…

### Regions

Each content type can have one or more regions to contain the content of a post.

### Blocks

Within each region content editors can add one or more blocks
