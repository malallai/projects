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

void fillit(char **argv)
{
	int			ret;
	t_tetris	*tetris;
	t_infos		*infos;

	ret = 0;
	infos = new_infos();
	if (!new_tetris(&tetris, infos, 0))
		return (print_error());
	while ((ret = read_tetris(ft_atoi(argv[2]), &tetris, infos)) == 1)
		;
	if (ret == -1)
		return (print_error());
	print_arrays(tetris);
	free_tetris(&tetris);
	free(infos);
}
