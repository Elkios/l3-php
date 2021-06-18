up: ## Launch all the container
	docker-compose up

down: ## Stop all the container
	docker-compose down

ssh:
	docker-compose exec apache bash

