/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_ls.h                                            :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/02/02 14:33:12 by bclerc            #+#    #+#             */
/*   Updated: 2019/03/16 13:48:22 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#ifndef FT_LS_H
# define FT_LS_H
# include <stdio.h>
# include <sys/types.h>
# include <sys/stat.h>
# include <pwd.h>
# include <grp.h>
# include <time.h>
# include <dirent.h>
# include "libft/libft.h"

# define F_DETAIL 1
# define F_RECURS 2
# define F_ALL 4
# define F_REVERSE 8
# define F_TIME 16

# define F_DIR (char)'d'
# define F_LINK (char)'l'
# define ILLEGAL_OPTION 150

typedef struct		s_file
{
	char			*name;
	struct s_file	*next;
}					t_file;

typedef struct		s_opt
{
	int				flag;
	int				max;
	char			*path;
	t_file			*file;
	t_file			*folder;
}					t_opt;

int					parse(char **argv, t_opt *opt);
int					ls_print(t_opt *opt);

#endif
