for entry in $1/*.c
do
	echo ========= $entry =========
	diff $entry $2/$entry
done
