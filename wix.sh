#!/bin/bash
echo "Ingrese nombre del nuevo proyecto, luego presione la tecla enter:"
read nombre

select opcion in Vacio Estructura Ejemplo Salir
do
	case $opcion in
		"Vacio")
		mkdir -p "$nombre"
            cd $nombre
            echo "<html><body></body></html>" | cat > index.php
            echo "Se creo el proyecto $proyecto en blanco"
            exit
            ;;
            	"Estructura" )
	mkdir -p $nombre/{css/{user,admin},img/{avatars,buttons,products,pets},js/{validations,effects},tpl,php}
	echo "Se creo el proyecto $proyecto con estructura"
	exit
		;;
		"Ejemplo" )
	mkdir -p $nombre/{css/{user,admin},img/{avatars,buttons,products,pets},js/{validations,effects},tpl,php}
cd $nombre
echo $nombre | cat > index.php 
cd css
cd user
echo | cat > estilo.css
cd .. 
cd admin 
echo | cat > estilo.css
cd ..
cd ..
cd img 
cd ..
cd js
cd validations
echo | cat > login.js
echo | cat > register.js
cd .. 
cd effects
echo | cat > panels.js
cd ..
cd ..
cd tpl
echo | cat > main.tpl
echo | cat > login.tpl
echo | cat > register.tpl
echo | cat > panel.tpl
echo | cat > profile.tpl
echo | cat > crud.tpl
cd ..
cd php
echo | cat > create.php
echo | cat > read.php
echo | cat > update.php
echo | cat > delete.php
echo | cat > dbconect.php
echo "Se creo el proyecto $proyecto con ejemplos"
exit
		
		;;
		"Salir" )
		exit
		
		;;
	* )
			echo "1) Vacio"
			echo "2) Estructura"
			echo "3) Ejemplo"
			echo "4) Salir"
			;;


esac 
done
