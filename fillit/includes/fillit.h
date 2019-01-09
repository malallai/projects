/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   fillit.h                                           :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/01/08 11:57:33 by malallai          #+#    #+#             */
/*   Updated: 2019/01/08 12:32:08 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

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

typedef	struct		s_infos
{
	t_tetris		*last;
	int				size;
	int				x;
	int				y;
}					t_infos;

void				fillit(char **argv);
int					read_tetris(int fd, t_tetris **tetris, t_infos *infos);
int					is_valid_char(char c);
void				print_error(void);
char				**new_array(void);
void				**free_array(char **array);
void				free_tetris(t_tetris **tetris);
int					new_tetris(t_tetris **tetris, t_infos *infos, int id);
int					edit_infos(t_infos *infos, char c, int end);
t_infos				*new_infos(void);

#endif
