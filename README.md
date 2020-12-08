## Git Codes

# Primeiro Commit
	git init
	git remote add origin (link do repositório)
	git add --all
	git commit -m "Descrição do commit"
	git push -u origin master

# Commit
	git add --all
	git commit -m "Descrição do commit"
	git push

# Commit da branch Master para Branch Production
	git push origin master:production

# Codigo do Action
	on:
		push:
			branches: [ production ]
	name: 🚀 Deploy website on push
	jobs:
		web-deploy:
			name: 🎉 Deploy
			runs-on: ubuntu-latest
			steps:
			- name: 🚚 Get latest code
				uses: actions/checkout@v2.3.2

			- name: Use Node.js 12
				uses: actions/setup-node@v2-beta
				with:
					node-version: '12'

			- name: Get yarn cache directory path
				id: yarn-cache-dir-path
				run: echo "::set-output name=dir::$(yarn cache dir)"
			- uses: actions/cache@v2
				id: yarn-cache # use this to check for `cache-hit` (`steps.yarn-cache.outputs.cache-hit != 'true'`)
				with:
					path: ${{ steps.yarn-cache-dir-path.outputs.dir }}
					key: ${{ runner.os }}-yarn-${{ hashFiles('**/yarn.lock') }}
					restore-keys: |
						${{ runner.os }}-yarn-
			- name: 🔨 Build Project
				run: |
					yarn install
					yarn build
			- name: 📂 Sync files
				uses: SamKirkland/FTP-Deploy-Action@4.0.0
				with:
					server: ${{ secrets.FTP_HOST }}
					username: ${{ secrets.FTP_USER }}
					password: ${{ secrets.FTP_PASS }}
					local-dir: ./build/
					server-dir: ./httpdocs/
