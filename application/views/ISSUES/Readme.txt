0. Set up a codeigniter - its a dependency
1. Change the doctrine code in model to normal codeigniter model code
2. the system uses sessions from main system - in the views/issues_v/header.php update session variables to match yours
3. To mark issues as solved navigate to [ROOT/issues/issue_review/{id}]