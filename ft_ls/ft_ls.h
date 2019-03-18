/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_ls.h                                            :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/03/16 14:02:37 by malallai          #+#    #+#             */
/*   Updated: 2019/03/18 15:42:54 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#ifndef FT_LS_H
# define FT_LS_H
# include <dirent.h>
# include <sys/types.h>
# include <sys/stat.h>
# include <pwd.h>
# include <uuid/uuid.h>
# include <grp.h>
# include <sys/xattr.h>
# include <time.h>
# include <stdio.h>
# include "libft/libft.h"

# define F_DETAIL 1
# define F_RECURS 2
# define F_ALL 4
# define F_REVERSE 8
# define F_TIME 16

# define F_DIR (char)'d'
# define F_LINK (char)'l'

# define DEBUG printf

typedef struct			s_entry {
	char				**a;
	int					count;
	int					max;
}						t_entry;

typedef struct			s_file {
	struct dirent		*dirent;
	struct s_file		*next;
}						t_file;

typedef struct			s_opt
{
	int					flag;
	int					init;
	struct s_entry		*entries;
	struct s_entry		*files;
	struct s_entry		*folders;
	struct s_file		*first;
	struct s_file		*last;
}						t_opt;

typedef struct			s_infos {
	char				*name;
	char				*mode;
	struct stat			stat;
	struct dirent		*dirent;
	struct passwd		*uid;
	struct group		*gid;
}						t_infos;

t_file					*new_file(void);
void					add_file(t_opt *opt, struct dirent *dirent);
void					free_entries(t_entry *entry);
void					free_file(t_file *file);
t_opt					*new_opt(void);
void					set_opt_folders(t_opt *opt, int argc, char **argv,
						int index);
void					free_opt(t_opt *opt);
char					get_dtype(unsigned char type);
char					*get_color(char type, int mode);
int						set_flag(char c_flag, t_opt *opt);
int						parse(char **argv, t_opt *opt);
void					free_array(char **array, int size);
int						is_regular_file(const char *path);
int						is_folder(const char *path);
void					print_nexist(char *str);
int						exist(const char *path);
t_entry					*new_entry(void);
void					read_folders(t_opt *opt);
void					read_files(t_opt *opt);
char					*print_mode(int mode, unsigned char type);
void					split_entries(t_opt *opt);
void					quicksort(char **array, int low, int high);
void					swap(char **array, int a, int b);
void					display(t_opt *opt, t_infos *infos, int size_max);
void					display_details(t_opt *opt, t_infos *infos,\
						int size_max);
void					read_files(t_opt *opt);
void					read_folders(t_opt *opt);
t_infos					*get_finfos(char *path);
t_infos					*get_dinfos(char *path, struct dirent *dirent);
int						has_flag(t_opt *opt, int flag);
void					max_size(t_opt *opt);

#endif
