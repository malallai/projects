Main > "sleep(15); while(1);"
export MallocStackLogging=YES
./a.out &
leaks pid
kill pid

valgrind --tool=memcheck --leak-check=full ./gnl gnl10.txt