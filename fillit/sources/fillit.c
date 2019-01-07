#include "../includes/fillit.h"

void    print_arrays(t_tetris *tetris)
{
	char **array;

	while (tetris->next)
	{
		array = tetris->array;
		while (*array)
			printf("%s\n", *array++);
		printf("\n");
		tetris = tetris->next;	
	}
}

void fillit(int argc, char **argv)
{
	int		ret;
	int		fd;

	ret = 0;
	if (argc != 2)
	{
		ft_putendl("Usage: ./fillit [file]");
		return;
	}
	else
	{
		fd = open(argv[1], O_RDONLY);
		if (fd < 0)
			return (print_error());
		t_tetris *tetris;
		tetris = (t_tetris *)malloc(sizeof(t_tetris));
		tetris->next = NULL;
		tetris->id = 0;
		while ((ret = read_tetris(fd, &tetris)) == 1)
			;
		if (ret == -1)
			return (print_error());
		print_arrays(tetris);
	}
}
