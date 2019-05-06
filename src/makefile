.PHONY: deploy
deploy: template functions

.PHONY: template
template:
	faas-cli template store pull php7
	faas-cli template store pull csharp
	cp -r ../template/php7-3 ./template

.PHONY: functions
functions:
	faas-cli build -f hello-csharp.yml
	faas-cli deploy -f hello-csharp.yml
	faas-cli build -f search-user.yml
	faas-cli deploy -f search-user.yml
	faas-cli build -f users.yml
	faas-cli deploy -f users.yml