/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   fillit.h                                           :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/01/08 11:57:33 by malallai          #+#    #+#             */
/*   Updated: 2019/01/19 15:03:59 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#ifndef FILLIT_H
# define FILLIT_H
# include "libft/libft.h"
# include <fcntl.h>
# include <stdio.h>
# define _DEBUG_ printf

typedef struct		s_tetris
{
	char			**full_array;
	char			**array;
	char			*chard;
	int				width;
	int				height;
	int				id;
	struct s_tetris *parent;
	struct s_tetris	*next;
}					t_tetris;

typedef struct		s_pos
{
	int				x;
	int				y;
	int				index;
}					t_pos;

typedef struct		s_map
{
	char			**array;
	int				size;
}					t_map;

typedef	struct		s_params
{
	t_tetris		*tetris;
	t_tetris		*last;
	t_map			*map;
	int				size;
	int				fd;
	int				init;
	char			*buff_tmp;
}					t_params;

int					fillit(t_params *params);
int					ft_sqrt(int x);
int					read_tetris(t_params *params);
int					is_valid_char(char c, int i);
int					exit_fillit(t_params *params, int error);
char				**new_array(void);
int					new_tetris(t_params *params);
int					free_tetris(t_tetris *tetris);
t_params			*new_params(int fd);
char				*convert_to_string(t_tetris *tetris, char c);
int					check_tetro(t_params *params);
int					check_connection(t_tetris *tetris);
t_map				*new_map(t_params *params, size_t size);
int					solve(t_params *params);
int					solve_map(t_params *params, t_tetris *tetris);
int					try_set(t_params *params, t_tetris *tetris, t_pos *pos);
int					set(t_params *params, t_tetris *tetris, t_pos *pos, \
					char to_set);
t_pos				*new_pos(int x, int y);
int					edit_pos(t_pos *pos, int max_x, int max_y, char c);
int					check(char *str, int index);
int					remove_dots(t_tetris *tetris);
void				get_size(t_tetris *tetris);

#endif
