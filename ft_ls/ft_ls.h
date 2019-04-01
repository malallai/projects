/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_ls.h                                            :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/03/16 14:02:37 by malallai          #+#    #+#             */
/*   Updated: 2019/04/01 19:21:53 by malallai         ###   ########.fr       */
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
# define F_BLOCKS 32

# define WHITE (char *)"\033[0m"
# define CYAN (char *)"\033[1;36m"
# define RED (char *)"\033[0;31m"
# define PURPLE (char *)"\033[0;35m"

# define GREEN (char *)"\033[38;5;118m"
# define YELLOW (char *)"\033[38;5;226m"

# define F_DIR (char)'d'
# define F_LINK (char)'l'

# define DEBUG printf

/*
** Contain the hightest strlen of params (-l)
** int	blocks:			ls -ls	first param
** int	links:			ls -l	second param
** int	uid:			ls -l	third param
** int	gid:			ls -l	fourth param
** int	size:			ls -l	fifth param
** int	t:				ls -l	last edited
*/
typedef struct			s_infosize
{
	int					blocks;
	int					links;
	int					uid;
	int					gid;
	int					size;
	int					date;
}						t_infosize;

typedef struct			s_infos
{
	char				*display_name;
	char				*path;
	struct stat			file_stat;
	char				*perms;
	struct passwd		*uid;
	struct group		*gid;
	char				*date;
	int					millis;
	t_infosize			*sizes;
}						t_infos;

typedef struct			s_file
{
	int					id;
	struct s_file		*next;
	struct s_file		*prev;
	char				*name;
	char				*path;
	t_infos				*infos;
}						t_file;

typedef struct			s_folder
{
	t_file				*folder;
	t_file				*first;
	t_file				*file;
	int					size;
	int					size_all;
	int					count;
}						t_folder;

/*
** int	flag:			flag sent by user
** int	error:			0|1 -> 0 no error during execution \
** | 1 error during execution
** char	*flags:			available flags
*/
typedef struct			s_opt
{
	int					flag;
	int					error;
	char				*flags;
	t_folder			*main;
}						t_opt;

/*
** files.c
*/
int						is_parent_path(char *str);
int						to_folder(char *name, char *entry_name);

/*
** free_ftls.c
*/
void					free_infos(t_infos *infos);
void					free_file(t_file *file);
void					free_folder(t_folder *folder);
void					free_opt(t_opt *opt);

/*
** ft_ls_exit.c
** int	bad_option:		when bad option is detected (-[laR...])
** void	print_nexist:	if file not found
** int	exit_ftls:		exit ls with return statement and free
*/
int						bad_option(t_opt *opt, char option);
void					print_nexist(t_opt *opt, t_file *file);
int						exit_ftls(t_opt *opt);

/*
** lst.c
*/
t_file					*new_file(int id, char *name, char *parent);
t_infos					*get_infos(t_file *file);
t_infosize				*get_sizes(t_infos *info, struct stat pstat);
t_folder				*new_folder(t_file *file);

/*
** opt.c
** t_opt	*init_opt:	init opt var (@see struct s_opt)
*/
t_opt					*init_opt(void);

/*
** parser.c
*/
int						set_flag(char c_flag, t_opt *opt);
int						parse(char **argv, t_opt *opt);
void					set_main_files(t_opt *opt, int argc, \
						char **argv, int index);

/*
** print_put.c
*/
void					put_lnk(t_file *file);
void					put_nbr(int nbr, int tab, int spaces, int max);
void					put_str(char *str, int tab, int spaces, int max);

/*
** printer.c
*/
void					print_file(t_opt *opt, t_file *file);
void					print_folder(t_opt *opt, t_folder *folder, int name);
void					print_details(t_file *file);

/*
** reader.c
*/
void					read_folder(t_opt *opt, t_folder *folder, int name);
void					update_read_folder(t_folder *folder, \
						t_file *tmp, int index);
void					ls(t_opt *opt, t_file *file, int f);

/*
** sort.c
*/
void					sort(t_opt *opt, t_folder *folder, int low, int high);
void					sort_ascii(t_folder *folder, int low, int high);
void					sort_time(t_folder *folder, int low, int high);
int						compare(int t, t_file *f1, t_file *f2, int i);

/*
** stat_ftls.c
*/
int						is_regular_file(const char *path);
int						is_folder(const char *path);
int						exist(t_file *file);
char					*lsgetlink(char *path);
t_file					*get_file(t_file *first, int id);

/*
** swap.c
** void	swap:			swap two file (@see struct s_file)
** void swap_item:		swap two item of file (@see struct s_file)
*/
void					swap(t_file *a, t_file *b);
void					swap_item(t_file **a, t_file *cpy);

/*
** time.c
*/
char					*get_date(time_t date);

/*
** utils.c
*/
char					get_type(int mode);
char					*get_color(int mode);
char					*get_perms(int mode);
int						has_flag(t_opt *opt, int flag);

#endif
