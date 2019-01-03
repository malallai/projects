#include "../includes/fillit.h"

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
		ft_putendl(*array++);
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
				if (array[x][y] == '.')
				{
					if (array[x][y + 1] == '#' && array[x + 1][y] == '#')
						array[x][y] = '@';
				}
				if (x == 3 && y != 3)
				{
					x = 0;
					y++;
				}
				else
					x++;
			}
			
			print_tab(array);
			free(buffer);
			buffer = ft_strnew(22);
		}
		if (ret == -1)
			return error();
	}
}
