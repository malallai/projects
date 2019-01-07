#include "../includes/fillit.h"

void    print_arrays(t_tetris *tetris)
{
	char	**array;
	int		index;

	index = 0;
	while (tetris)
	{
		array = tetris->array;
		while (array[index])
			printf("id : %d line : %s\n", tetris->id, array[index++]);
		printf("\n");
		tetris = tetris->next;
		index = 0;
	}
}

void fillit(int argc, char **argv)
{
	int			ret;
	int			fd;
	t_pos		*pos;
	t_tetris	*tetris;

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
		pos = new_pos();
		tetris = init_tetris();
		while ((ret = read_tetris(fd, &tetris, pos)) == 1)
			;
		if (ret == -1)
			return (print_error());
		//print_arrays(tetris);
		free_tetris(&tetris);
		free(pos);
	}
}
