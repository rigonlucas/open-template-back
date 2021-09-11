## autoriza o docker a executar sem o comando sudo
sudo chmod 666 /var/run/docker.sock


##limpar docker
sail down --rmi all -v

sail up