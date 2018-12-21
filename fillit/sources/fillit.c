#include "../includes/fillit.h"

int	is_char(char c)
{
	return (c  && (c == '.' || c == '#' || c == '\n'));
}

t_piece	read_buff(char *buffer)
{
	int	x;
	int	y;
	int	index;
	t_piece piece;

	x = 0;
	y = 0;
	index = 0;
	piece = malloc(sizeof(t_piece));
	while (index != 25)
	{
		if (is_char(buffer[index]))
		{
			if (buffer[index] == '#')
			{
				piece
			}
			index++;
			x++;
		}
		else
			return (NULL);
		if (index % 5 == 0)
		{
			y++;
			x = 0;
			continue ;
		}
	}	
}

void	fillit(int argc, char ** argv)
{
	char	buffer[25];
	int	ret;

	if (argc != 2)
	{
		ft_putendl("Usage: ./fillit [file]");
		return ;
	}
	else
	{
		ret = read(argv[1], buffer, 24);
		buffer[24] = '\0';
		if (ret == -1)
		{
			ft_putendl("error");
			return ;
		}

	}
}
