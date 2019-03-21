#include <stdlib.h>
#include <stdio.h>

int main(int argc, char **argv) {
    t_test	test;

	test.test = 2;
	t(&test);
	printf("%d\n", test.test);
	return 0;
}