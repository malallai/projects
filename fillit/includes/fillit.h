/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   fillit.h                                           :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/01/08 11:57:33 by malallai          #+#    #+#             */
/*   Updated: 2019/01/09 17:41:33 by malallai         ###   ########.fr       */
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
	char			*charl;
	char			*chard;
}					t_tetris;

typedef	struct		s_infos
{
	t_tetris		*last;
	int				size;
	int				x;
	int				y;
	int				fd;
	t_tetris		**tetris;
}					t_infos;

int					fillit(int fd);
int					read_tetris(int fd, t_infos *infos);
int					is_valid_char(char c);
int					print_error(t_infos *infos);
int					exit_fillit(t_infos *infos);
char				**new_array(void);
int					new_tetris(t_infos *infos);
int					init_tetris(t_tetris **tetris, t_infos *infos);
int					edit_infos(t_infos *infos, char c, int end);
int					free_infos(t_infos *infos);
int					free_tetris(t_tetris **tetris);
int					free_array(char **array);
t_infos				*new_infos(int fd);
char				*convert_to_array(t_tetris *tetris, char c);
int					check_tetro(t_tetris *tetris, t_infos *infos);
int					check_connection(t_tetris *tetris);

#endif
