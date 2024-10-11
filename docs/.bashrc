#!/usr/bin/zsh

#Php
alias ci="composer install"
alias cu="composer update"
#Utilitarios
alias www="cd ~/Projetos"
alias reset="source ~/.zshrc && clear && cd"
alias myssh="cat ~/.ssh/id_rsa.pub | pbcopy && echo 'Chave copiada com sucesso' "
alias ll="ls -lha"
alias cls="clear"
alias pbcopy="xclip -selection clipboard"
alias pbpaste="xclip -selection clipboard -o"
#Docker
alias dcom="docker-compose"
alias drefresh="docker-compose down && docker-compose up -d"
alias dbuild="docker-compose build"
alias dup="docker-compose up -d"
alias ddown="docker-compose down"
alias dps="docker ps"
#Curl
alias cpf="curl -XPOST -s -d 'acao=gerar_cpf&pontuacao=N&cpf_estado=' 'https://www.4devs.com.br/ferramentas_online.php' | pbcopy"
alias cnpj="curl -XPOST -s -d'acao=gerar_cnpj&pontuacao=N&cpf_estado=' 'https://www.4devs.com.br/ferramentas_online.php' | pbcopy"
alias mip="curl -s https://api.ipify.org/ | pbcopy && echo 'Ip publico copiado com sucesso'"
#Extra

#functions
function dtail()
{
    LENGTH=$1
    CONTAINER=$2
    eval "docker logs --tail=$LENGTH $CONTAINER"
}

function dshell()
{
    CONTAINER=$1
    eval "docker exec -it $CONTAINER bash"
}

function dkill()
{
	for i in $(docker ps -a -q);
	do
		eval "docker stop $i && docker rm $i"
	done
}
