#ifndef FILLIT_H
# define FILLIT_H
# include "../libft/includes/libft.h"
# include <fcntl.h>
# include <stdio.h>

typedef struct		s_tetris
{
	char			**array;
	struct s_tetris	*next;
	int				id;
}					t_tetris;

typedef struct 		s_pos
{
	int				x;
	int				y;
}					t_pos;

void				fillit(int argc, char **argv);
int					read_tetris(int fd, t_tetris **tetris, t_pos *pos);

int					is_valid_char(char c);
void				print_error();

char				**new_array();
void				**free_array(char **array);
void				free_tetris(t_tetris **tetris);
int					new_tetris(t_tetris **tetris);
t_tetris			*init_tetris();

int					edit_pos(t_pos **pos, char c);
t_pos				*new_pos();


#endif
