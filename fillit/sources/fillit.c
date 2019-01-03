#include "../includes/fillit.h"
#include <stdio.h>

int is_char(char c)
{
	return (c && (c == '.' || c == '#' || c == '\n'));
}

void error()
{
	ft_putendl("error");
}

char **to_array(char *str) {
	char **array;
	int index;
	int str_index;
	int j;

	str_index = 0;
	index = 0;
	j = 0;
	array = (char **)malloc(sizeof(char **) * 4);
	while (index < 4)
	{
		array[index] = ft_strnew(4);
		while (str_index != 4)
			array[index][str_index++] = str[j++];
		j++;
		str_index = 0;
		index++;
	}
	return (array);
}

void	print_tab(char **array)
{
	while (*array)
		printf("%s\n", *array++);
}

void fillit(int argc, char **argv)
{
	char	*buffer;
	int		ret;
	int		fd;
	char	*tmp;
	char	**array;

	if (argc != 2)
	{
		ft_putendl("Usage: ./fillit [file]");
		return;
	}
	else
	{
		fd = open(argv[1], O_RDONLY);
		if (fd < 0)
			return error();
		buffer = ft_strnew(22);
		while ((ret = read(fd, buffer, 21)) > 0)
		{
			buffer[21] = '\0';

			tmp = ft_strreplace(buffer, '.', 0);
			tmp = ft_trimchar(tmp, '\n');
			array = to_array(buffer);
			int x = 0;
			int y = 0;
			while (x != 3 && y != 3)
			{
				printf("x: %d, y: %d c: %c\n", x, y, array[y][x]);
				if (array[y][x] == '.')
				{
					if (array[y][x + 1] == '#' && array[y + 1][x] == '#')
						array[y][x] = '@';
				}
				
			}
			
			print_tab(array);
			free(buffer);
			buffer = ft_strnew(22);
		}
		if (ret == -1)
			return error();
	}
}
