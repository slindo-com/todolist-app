## URLS

/
/sign-in/
/new-account/
/new-password/
/new-password/:token/
/invite/:token/

/settings/
/settings/teams/
/settings/teams/new-team/
/settings/teams/:team/
/settings/teams/:team/new-member/
/settings/account/
/settings/account/change-email/
/settings/account/change-password/

/:team/
/:team/important/
/:team/today/
/:team/week/
/:team/:list/
/:team/:list/:todo/




## MODELS

### USERS
id
email
password
name
avatar
created_at


## INVITES
token
team
email
name
created_by
created_at


## PASSWORD_RESETS
token
email
created_by
created_at


### TEAMS
id
title
created_by
created_at


### TEAM_MEMBERS
id
user
team
role


### LISTS
id
title
created_by
created_at
team
user


### TASKS
id
title
done
created_by
created_at
due
note
list


### TASKS
id
title
done
created_by
created_at
due
note
list


### SUB_TASKS
id
title
done
created_by
created_at
task


### COMMENTS
id
comment
created_by
created_at
task


