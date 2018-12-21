#ifndef FILLIT_H
# define FILLIT_H
# include "../libft/includes/libft.h"
# include <fcntl.h>

typedef struct	s_piece
{
	int	x;
	int	y;
	int	type;
}		t_piece;

void	fillit(int argc, char **argv);

#endif
