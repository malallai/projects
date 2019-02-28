/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_ls.h                                            :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: bclerc <bclerc@student.42.fr>              +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/02/02 14:33:12 by bclerc            #+#    #+#             */
/*   Updated: 2019/02/28 13:36:10 by bclerc           ###   ########.fr       */
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
	char			*mode;
	struct dirent	*dirent;
	struct group	*group;
	struct passwd	*passwd;
	struct stat		stat;
}					t_file;

typedef struct		s_folder	
{
	int i;
	int id;
	char *name;
	t_file *t_file;
	struct s_folder *first;
	struct s_folder *last;
	struct s_folder *next;
}					t_folder;

typedef struct		s_opt
{
	int					flag;
	struct	s_folder	*folder;
	struct	s_folder	*file;
	int					skip;
	int 				max;
	int					total;
}					t_opt;

t_file	*ls(struct dirent *sd, char *name);
int		parse(char **argc, t_opt *opt);
int		read_file(char **argv, int index, t_opt *opt);
char	*get_color(char type, int mode);
char	*get_path(char *argv, char *name);
char	*print_mode(int mode, unsigned char type);
char	get_dtype(unsigned char type);
void	printls(t_folder *folder, t_opt *opt);
void	destroyls(t_folder *folder);

# endif