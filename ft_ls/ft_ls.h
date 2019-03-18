/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_ls.h                                            :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/03/16 14:02:37 by malallai          #+#    #+#             */
/*   Updated: 2019/03/17 20:55:12 by malallai         ###   ########.fr       */
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

# define F_DIR (char)'d'
# define F_LINK (char)'l'

# define DEBUG printf

typedef struct			s_entry {
	char				**array;
	int					count;
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
int						ls_read(t_opt *opt);
void					free_array(char **array);
int						is_regular_file(const char *path);
int						is_folder(const char *path);

void	split_entries(t_opt *opt);
void quicksort(char **array, int low, int high);
void swap(char **array, int a, int b);

#endif
